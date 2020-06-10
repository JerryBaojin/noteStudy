
//用户表里新增 满足条件的月数
// meetMonth = 6,7,8
const users = [];
for (let index = 0; index <2000; index++) {
    users.push({
        _openid:index,
        meetMonth:"6,7,8",
        prizeLv:0
    })
}

//抽奖逻辑
let readyUsers = users.filter(val=>val.meetMonth === "6,7,8" && val.prizeLv==0)
//查看每个等级目前有多少人
let lv1 = readyUsers.filter(val=>  val.prizeLv==1 ).length
let lv2 = readyUsers.filter(val=>  val.prizeLv==2 ).length
let lv3 = readyUsers.filter(val=>  val.prizeLv==3 ).length
const prizeNumberTotal = [100,200,300]
//一等奖
while(lv1<100){
    //目前剩余数据总量有多少

    let leftData = users.filter(val=>val.meetMonth === "6,7,8" && val.prizeLv==0)
    let randomIdx = randomNum(0,leftData.length)
    leftData[randomIdx].prizeLv=1
    lv1++
}

while(lv2<200){
    //目前剩余数据总量有多少
    let leftData = users.filter(val=>val.meetMonth === "6,7,8" && val.prizeLv==0)
    let randomIdx = randomNum(0,leftData.length)
    leftData[randomIdx].prizeLv=2
    lv2++
}
while(lv3<300){
    //目前剩余数据总量有多少

    let leftData = users.filter(val=>val.meetMonth === "6,7,8" && val.prizeLv===0)
    let randomIdx = randomNum(0,leftData.length)
    leftData[randomIdx].prizeLv=3
    lv3++
}
//生成随机数
function randomNum(minNum,maxNum){ 
    switch(arguments.length){ 
        case 1: 
            return parseInt(Math.random()*minNum+1,10); 
        break; 
        case 2: 
            return parseInt(Math.random()*(maxNum-minNum+1)+minNum,10); 
        break; 
            default: 
                return 0; 
            break; 
    } 
} 

console.log(readyUsers.filter(val=>  val.prizeLv===1 ))
console.log(readyUsers.filter(val=>  val.prizeLv===2 ))
console.log(readyUsers.filter(val=>  val.prizeLv===3 ))