import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { GraphQLModule } from '@nestjs/graphql';
import { ApolloDriver, ApolloDriverConfig } from '@nestjs/apollo';
import { BookModule } from './modules/book/book.module';
import { HotelModule } from './modules/hotel/hotel.module';
import { BookingModule } from './modules/booking/booking.module';

@Module({
  imports: [
    GraphQLModule.forRoot<ApolloDriverConfig>({
      driver: ApolloDriver,
      playground: true,
      typePaths: ['./**/*.graphql'],
      
    }),
    BookModule,
    HotelModule,
    BookingModule,
   
  ],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
