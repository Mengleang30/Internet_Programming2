import { Controller, Get, Post, Body, Patch, Param, Delete } from '@nestjs/common';
import { TaskService } from './task.service';
import { CreateTaskDto } from './dto/create-task.dto';
import { UpdateTaskDto } from './dto/update-task.dto';
import { Task } from './entities/task.entity';

@Controller('tasks')
export class TaskController {
  constructor(private readonly taskService: TaskService) {}

  @Post()
  createTask(@Body() taskData: Partial<Task>) {
    return this.taskService.createTask(taskData);
  }

  @Get()
  findAll() {
    return this.taskService.findAll();
  }

  @Get(':id')
  findOne(@Param('id') id: number) {
    return this.taskService.findOne(id);
  }

  @Patch('complete/:id')
  completeTask(@Param('id') id: number) {
    return this.taskService.completeTask(id);
  }

  @Patch(':id')
  update(@Param('id') id: number, @Body() updateData: Partial<Task>) {
    return this.taskService.update(id, updateData);
  }

  @Delete('clear_all')
  async clearAll() {
    await this.taskService.clearAll();
    return {message: 'All tasks cleared successfully'};
  }

  @Delete(':id')
  remove(@Param('id') id: number) {
    return this.taskService.remove(id);
  }
 
 

}
