function A(a){
  this.a=a
}
function B(b,a){
  A.call(this,a)
  this.b=b
}

var str=new B("b","a")
console.log(str)
