# JavaScript基础
- this操作符
  + 创建一个全新的对象。
  + 这个新对象的原型(__proto__)指向函数的prototype对象。
  + 执行函数，函数的this会绑定在新创建的对象上。
如果函数没有返回其他对象(包括数组、函数、日期对象等)，那么会自动返回这个新对象。
  + 返回的那个对象为构造函数的实例。

- Object.create()实现
 ```
 function cloneObject(obj){
  function F(){}
  F.prototype = obj; // 将被继承的对象作为空函数的prototype
  return new F(); // 返回new期间创建的新对象,此对象的原型为被继承的对象, 通过原型链查找可以拿到被继承对象的属性
}
 ```
