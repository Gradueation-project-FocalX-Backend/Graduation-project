 ##### Graduation Project 


- Downlaod the project.

#commands to use before run project.
1- composer update.
2-change the name of file ( .env.example ) TO => (.env).
3- php artisan key:generate .



## how to user dashboard.

Example: you have 3 main commands to write.


-- Extends the constants ( Navbar , Sidebar , Footer) of the dashboard to each blade file we create using :
  --->      @extends('dashboard')


--change the *title* of your blade file if you need usiog :  @section('title', 'you file title')  

EX : @section ('title' , 'Add new user')

- change the *content* that you are working on it in you blade file using : 

@section('content')

    PUT YOU WORK HERE PLEASE.

@endsection




## THe Result of you blade file will be like this:

@extends('dashbaord')

@section('title', 'All categories')

@section('content')

    PUT YOU WORK HERE PLEASE.

@endsection