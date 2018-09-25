<?php

namespace controllers;

class IndexController
{
    function index()
    {
        view('index/index');
    }
    function main()
    {
        view('index/main');
    }
    function menu()
    {
        view('index/menu');
    }
    function top()
    {
        view('index/top');
    }
}