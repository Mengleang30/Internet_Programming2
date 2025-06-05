import { IsEmail, IsEmpty, IsNotEmpty, MinLength } from 'class-validator';
export class CreateUserDto {
    @IsNotEmpty()
    username: string;

    @IsEmail()
    email: string;

    @MinLength(3)
    password: string;
}
