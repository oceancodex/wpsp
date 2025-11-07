<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Events\\EventServiceProvider',
    1 => 'Illuminate\\Redis\\RedisServiceProvider',
    2 => 'Illuminate\\Queue\\QueueServiceProvider',
    3 => 'Carbon\\Laravel\\ServiceProvider',
    4 => 'Termwind\\Laravel\\TermwindServiceProvider',
    5 => 'WPSP\\app\\Providers\\AppServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Events\\EventServiceProvider',
    1 => 'Carbon\\Laravel\\ServiceProvider',
    2 => 'Termwind\\Laravel\\TermwindServiceProvider',
    3 => 'WPSP\\app\\Providers\\AppServiceProvider',
  ),
  'deferred' => 
  array (
    'redis' => 'Illuminate\\Redis\\RedisServiceProvider',
    'redis.connection' => 'Illuminate\\Redis\\RedisServiceProvider',
    'queue' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.connection' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.failer' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.listener' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.worker' => 'Illuminate\\Queue\\QueueServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Redis\\RedisServiceProvider' => 
    array (
    ),
    'Illuminate\\Queue\\QueueServiceProvider' => 
    array (
    ),
  ),
);