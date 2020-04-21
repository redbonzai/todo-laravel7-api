
## About Todo Laravel 7 API

This API is built to serve the TODO VueJS single page application located here [TODO LIST Vue JS SPA](https://github.com/redbonzai/todo-vue-spa)

> Functionality is as follows: 

- The user can create todos
- TODOS can be edited by simply clicking on a todo item and overriting it.  Pressing enter saves it to the database.
- The user can mark a todo item as complete
- The user can filter through their todo items ( all, complete, or active )
- The user can remove all the completed todos with a simple click 
- The user can mark all the todos as completed with a simple click.  


## Starting up the API

 - Get the Postman Collection here: [https://www.getpostman.com/collections/7ac71e28460b00223f6f](TODO Laravel Postman Collection)
 - Clone the API : 
```bash
git clone https://github.com/redbonzai/todo-laravel7-api.git todo-laravel-api
```
- Then Clone the Vue JS single page application
```bash 
git clone https://github.com/redbonzai/todo-vue-spa.git
```
- Before starting the api we must create the .env file
> enter the appropriate env variables for Datasource connection
```bash
cp .env.example .env
```
- Copy into the root directory and start the local server (it starts on port 8000): 
```bash
cd ~/Projects/todo-laravel-api && php artisan serve
```

- Test the Postman collection

- Run the TODO VUE SPA ( starts on port 8080)
```bash
cd ~/Projects/todo-vue-spa
```

#### The Frontend application loads on http://localhost:8080

#### The API application loads on http://localhost:8000

