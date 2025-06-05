import { Injectable, NotFoundException } from '@nestjs/common';
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { Repository } from 'typeorm';
import { User } from './entities/user.entity';
import { InjectRepository } from '@nestjs/typeorm';

@Injectable()
export class UserService {
  constructor(
    @InjectRepository(User)
    private userRepo: Repository<User>,
  ) {}

  createUser(userData: Partial<User>){
    const user = this.userRepo.create(userData);
    return this.userRepo.save(user);
  }
  findAll(){
    return this.userRepo.find({
      relations: ['tasks'],
    });
  }
  async findOne(id: number){
    const user = await this.userRepo.findOne({
      where: { id },
      relations: ['tasks']});
    if (!user) {
      throw new NotFoundException(`User with id ${id} not found`);
    }

    return user;
  }

  async update(id: number, updateData: Partial<User>){
    await this.userRepo.update(id, updateData);
    return this.findOne(id)
  }

  async remove(id: number) {
    const user = await this.userRepo.findOne({ where: { id } });
    if (!user) {
      throw new NotFoundException(`User with id ${id} not found`);
    }
    return this.userRepo.delete(id);
  }
}
