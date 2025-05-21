import { Injectable } from '@nestjs/common';
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
  findOne(id: number){
    return this.userRepo.findOne({
      where: { id },
      relations: ['tasks'],
    });
  }

  async update(id: number, updateData: Partial<User>){
    await this.userRepo.update(id, updateData);
    return this.findOne(id)
  }

  remove(id: number){
    return this.userRepo.delete(id);
  }
}
