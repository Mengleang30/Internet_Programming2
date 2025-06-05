import { IsInt, IsNotEmpty, IsOptional, IsString } from "class-validator";

export class CreateTaskDto {
    @IsNotEmpty()
    @IsString()
    name: string;

    @IsOptional()
    @IsString()
    description: string;

    @IsInt()
    userId: number;
}
