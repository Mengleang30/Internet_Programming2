import { Resolver, Query, Args, Mutation } from '@nestjs/graphql';
import { HotelService } from './hotel.service';

@Resolver('Hotel')
export class HotelResolver {
   private hotels = [
    {
      id: 1,
      name: 'Hotel1',
      address: 'Phnom Penh',
      phone: "077 777 7777",
    },
     {
      id: 2,
      name: 'Hotel2',
      address: 'Phnom Penh',
      phone: "077 777 7777",
    },
     {
      id: 3,
      name: 'Hotel3',
      address: 'Phnom Penh',
      phone: "077 777 7777",
    },
   
  ];
  @Query('hotels')
  getAllHotels(){
    return this.hotels;
  };
  @Query('hotel')
  getBookById(@Args('id') id: number) {
      return this.hotels.find((h) => h.id == id);
   };
  @Mutation('addHotel')
     addHotel(@Args('name') name: string, @Args('address') address: string ,@Args('phone') phone: string ) {
       const sortedHotels = this.hotels.sort((a, b) => a.id - b.id);
       const lastId =
         sortedHotels.length > 0 ? sortedHotels[sortedHotels.length - 1].id : 0;
       const newHotel = {
         id: lastId + 1,
         name,
         address,
         phone,
       };
       this.hotels.push(newHotel);
       return newHotel;
     }

  @Mutation('updateHotel')
  updateHotel(
  @Args('id') id: number,
  @Args('name') name: string,
  @Args('address') address: string,
  @Args('phone') phone: string,
) {
  const hotelIndex = this.hotels.findIndex((h) => h.id === id);
  if (hotelIndex === -1) {
    throw new Error('Hotel not found');
  }
  const updatedHotel = { ...this.hotels[hotelIndex], name, address, phone };
  this.hotels[hotelIndex] = updatedHotel;
  return updatedHotel;
}

  @Mutation('deleteHotel')
  deleteHotel(@Args('id') id: number) {
    const hotelIndex = this.hotels.findIndex((h) => h.id === id);
    if (hotelIndex === -1) {
      throw new Error('Hotel not found');
    }
    const deletedHotel = this.hotels[hotelIndex];
    this.hotels.splice(hotelIndex, 1);
    return deletedHotel;
  }

}
