import { Module } from '@nestjs/common';
import { BookingService } from './booking.service';
import { BookingResolver } from './booking.resolver';

@Module({
  providers: [BookingResolver, BookingService],
})
export class BookingModule {}
