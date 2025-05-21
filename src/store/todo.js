import { defineStore } from "pinia";
import axios from "axios";

export  const useTodoStore = defineStore("todo", {
  state: () => ({
    todos: [],
  }),
  getters: {

  },
  actions: {
    async fetchTodos() {
        try {
            const response = await axios.get("http://localhost:3100/tasks");
            this.todos = response.data;
        }
        catch (error) {
            console.error("Error fetching todos:", error);
        }
  },
    async addTodo(newTodo) {
        try {
            const response = await axios.post("http://localhost:3100/tasks", newTodo);
            this.todos.push(response.data);
        } catch (error) {
            console.error("Error adding todo:", error);
        }
    },
   
    
}
});
