import { Resolver, Query, Mutation, Args } from '@nestjs/graphql';

interface Booking {
  id: number;
  hotel_id: number;
  start_date: Date;
  end_date: Date;
  is_checked_in: boolean;
  price: number;
}

@Resolver('Booking')
export class BookingResolver {
  private bookings: Booking[] = [];
  private lastId = 0;

  // Book an hotel (create booking)
  @Mutation('bookHotel')
  bookHotel(
    @Args('hotel_id') hotel_id: number,
    @Args('start_date') start_date: string,
    @Args('end_date') end_date: string,
    @Args('price') price: number,
  ) {
    const newBooking = {
      id: ++this.lastId,
      hotel_id,
      start_date: new Date(start_date),  // convert string to Date
      end_date: new Date(end_date),
      is_checked_in: false,
      price,
    };
    this.bookings.push(newBooking);
    return newBooking;
  }

  
  // Check in to hotel (update is_checked_in)
  @Mutation('checkIn')
  checkIn(@Args('id') id: number) {
    const booking = this.bookings.find(b => b.id === id);
    if (!booking) throw new Error('Booking not found');
    booking.is_checked_in = true;
    return booking;
  }

  // Cancel a booking (delete)
  @Mutation('cancelBooking')
  cancelBooking(@Args('id') id: number) {
    const index = this.bookings.findIndex(b => b.id === id);
    if (index === -1) throw new Error('Booking not found');
    const deleted = this.bookings[index];
    this.bookings.splice(index, 1);
    return deleted;
  }


  // Get bookings between start and end date
  @Query('bookingsByDateRange')
  bookingsByDateRange(
    @Args('start') start: string,
    @Args('end') end: string,
  ) {
    const startDate = new Date(start);
    const endDate = new Date(end);
    return this.bookings.filter(b => b.start_date >= startDate && b.end_date <= endDate);
  }
}
