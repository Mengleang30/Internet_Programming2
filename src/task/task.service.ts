import { Injectable, NotFoundException } from '@nestjs/common';
import { Task } from './entities/task.entity';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';

@Injectable()
export class TaskService {
  constructor(
    @InjectRepository(Task)
    private taskRepo: Repository<Task>,
  ) {}

  createTask(userData: Partial<Task>) {
    const user = this.taskRepo.create(userData);
    return this.taskRepo.save(user);
  }

  findAll() {
    return this.taskRepo.find({
      relations: ['user'],
    });
  }

  async findOne(id: number) {
    const task = await this.taskRepo.findOne({
      where: { id },
      relations: ['user'],
    });
    if (!task) {
      throw new NotFoundException(`Task with id ${id} not found`);
    }

    return task;
  }
  async update(id: number, updateData: Partial<Task>) {
    await this.taskRepo.update(id, updateData);
    return this.findOne(id);
  }
  remove(id: number) {
    return this.taskRepo.delete(id);
  }

  clearAll() {
    return this.taskRepo.clear();
  }

  async completeTask(id: number) {
    const task = await this.taskRepo.findOne({ where: { id } });
    if (!task || task.completedAt !== null) {
      return this.taskRepo.update(id, { completedAt: null });
    }
    await this.taskRepo.update(id, { completedAt: new Date() });
    return this.findOne(id);
  }
}
