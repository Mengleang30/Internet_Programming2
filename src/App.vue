<script setup>
import { useTodoStore } from './store/todo';
import { computed, onMounted, ref } from 'vue';

const tasks = useTodoStore();



onMounted(() => {
  tasks.fetchTodos();
});

const completedTasks = computed(() => {
  return tasks.todos.filter(task => task.completedAt !== null);
});

const pendingTasks = computed(() => {
  return tasks.todos.filter(task => task.completedAt === null);
});

const newTask = ref();
const addTask = () => {
  if (tasks.newTask.trim() === '') {
    return;
  }
  tasks.addTodo(tasks.newTask);
  tasks.newTask = '';
};


</script>

<template>
  <div class="container">
    <h2>Task Management</h2>
    <div class="new_Task">
        New Task
        <input type="text" v-model="newTask" placeholder="Enter Task" />
        <button @click="addTask(newTask)">Add</button>
    </div>
    <div >
      <div >
         <h4>Complete Tasks</h4>
         <div class="each_task" v-for="tasks in completedTasks" :key="tasks.id">
          <span>{{ tasks.name }}</span>
          <input type="checkbox" :checked="tasks.completedAt !== null"/>
         </div>
      </div>
      
      <div class="complete_Task">
        <h4 class="">Pending Tasks</h4>
  
        <div class="each_task" v-for="tasks in pendingTasks" :key="tasks.id">
          {{ tasks.name }}
           <input type="checkbox" :checked="tasks.completedAt !== null"/>
        </div>
      </div>
    </div>
  </div>

</template>

<style scoped>
.container{
  display: flex;
  flex-direction: column;
  background-color: antiquewhite;
  padding: 1rem;
  min-height: 100vh;
}

h4{
  color: #000;
  font-size: 20px;
  font-weight: bold;
}

.new_Task{
  display: flex;
  gap: 10px;
  align-items: center;
  padding: 0.5rem;
  border-radius: 5px;
  background-color: #fff;
  margin-bottom: 0.5rem;
}
.new_Task input{
  padding: 0.5rem;
  border-radius: 5px;
  border: 1px solid #ccc;
  width: 50%;
}
.each_task{
  display: flex;
  justify-content: space-between;
  gap: 10px;
  align-items: center;
  padding: 0.5rem;
  border-radius: 5px;
  background-color: #fff;
  margin-bottom: 0.5rem;
  width: 40%;
}
</style>
