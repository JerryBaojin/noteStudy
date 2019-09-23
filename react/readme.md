# react知识点
- 事件合成
 ```
 React并不是将click事件绑在该div的真实DOM上，而是在document处监听所有支持的事件，当事件发生并冒泡至document处时，React将事件内容封装并交由真正的处理函数运行。

 ```
 - diff算法
    - 策略原则
        + 两个不同类型的元素会产生不同的树
        + 对于同一层级的一组子节点，它们可以通过唯一 key 进行区分
        + 跨层级的操作很少

    - 比较原则
        + 只会进行同级比较,同一父节点下的所有子节点
        + 当发现节点已经不存在，则该节点及其子节点会被完全删除掉，不会用于进一步的比较
    - 比较顺序
        + `tagType->element->`
- virtualDom
`VitrualDom帮助我们提高了开发效率，在重复渲染时它帮助我们计算如何更高效的更新，而不是它比DOM操作更快`
- setState
由执行机制看，setState本身并不是异步的，而是如果在调用setState时，如果react正处于更新过程，当前更新会被暂存，等上一次更新执行后在执行，这个过程给人一种异步的假象。
在生命周期，根据JS的异步机制，会将异步函数先暂存，等所有同步代码执行完毕后在执行，这时上一次更新过程已经执行完毕，isBranchUpdate被设置为false，根据上面的流程，这时再调用setState即可立即执行更新，拿到更新结果。

>在componentDidMount()中，你 可以立即调用setState()。它将会触发一次额外的渲染，但是它将在浏览器刷新屏幕之前发生。这保证了在此情况下即使render()将会调用两次，用户也不会看到中间状态。谨慎使用这一模式，因为它常导致性能问题。在大多数情况下，你可以 在constructor()中使用赋值初始状态来代替。然而，有些情况下必须这样，比如像模态框和工具提示框。这时，你需要先测量这些DOM节点，才能渲染依赖尺寸或者位置的某些东西。
- React将虚拟DOM的更新过程划分两个阶段，reconciler阶段与commit阶段。reconciler阶段对应早期版本的diff过程，commit阶段对应早期版本的patch过程。

