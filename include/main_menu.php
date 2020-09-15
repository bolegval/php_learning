<?php 
require($_SERVER['DOCUMENT_ROOT'] . '/data/menu.php');

/**
 * Функция обрезки строки
 * @param string $line строка
 * @param integer $lengt hмаксимальное количество символов
 * @param string $appends строка вставки после максимального колтчества символов
 * @return string отформатированная строка
 */
function cutString($line, $length = 12, $appends = '...'): string
{
   return  mb_strimwidth($line, 0, $length, $appends); 
}

/**
 * Функция сортировки меню по ключу
 * @param array $array сортируемый массив
 * @param string $key ключ, по которому сортируется массив
 * @param string $sort направление сортировки
 * @return array отсортированный массив
 */
function arraySort(array $array, $key = 'title', $sort = SORT_ASC): array
{
   foreach ($array as $index => $item) {
      $menuItem[$index] = $item[$key];
   }
   
   array_multisort($menuItem, $sort, $array);
   return $array;  
}

/**
 * Функция проверки url
 * @param string $url проверяемый адрес url
 * @return bool true или false
 */
function isCurrentUrl($url){
   return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $url;
}

/**
 * Функция вывода меню
 * @param array $array исходный массив для вывода
 * @return sring
 */
function pageTitle($array) {
   for ($i = 0; $i < count($array) ; $i++) { 
      if (isCurrentUrl($array[$i]['path'])) {
         return $title = $array[$i]['title'];
      }
   }
   return 'Страница не найдена';
}

/**
 * Функция определения активного меню
 * @param array $array массив меню с ключом ['path']
 * @return string 'active'
 */
function active($array) {
   if (isCurrentUrl($array['path'])) {
      return 'active';
   }
}

/**
 * Функция вывода меню
 * @param array $array исходный массив для вывода
 * @param string $class класс меню для стилей
 * @return void список меню в соотвествии с данными в массиве
 */
function showMenu($array, $class='main-menu') {
   $array = arraySort($array, 'sort');
   include($_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php');
}