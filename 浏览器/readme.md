# [浏览器相关知识](https://juejin.im/post/5d89798d6fb9a06b102769b1)

- 浏览器渲染过程
    1. 浏览器获取HTML文件，然后对文件进行解析，形成DOM Tree
    2. 与此同时，进行CSS解析，生成Style Rules
    3. 接着将DOM Tree与Style Rules合成为 Render Tree
    4. 接着进入布局（Layout）阶段，也就是为每个节点分配一个应出现在屏幕上的确切坐标
    5. 随后调用GPU进行绘制（Paint），遍历Render Tree的节点，并将元素呈现出来

    ![流程图](https://user-gold-cdn.xitu.io/2019/9/24/16d61012054c505c?imageView2/0/w/1280/h/960/format/webp/ignore-error/1)
- 浏览器重绘与重排的区别？
    + 重排: 部分渲染树（或者整个渲染树）需要重新分析并且节点尺寸需要重新计算，表现为重新生成布局，重新排列元素
    + 重绘: 由于节点的几何属性发生改变或者由于样式发生改变，例如改变元素背景色时，屏幕上的部分内容需要更新，表现为某些元素的外观被改变
-  如何触发重排和重绘？
    - 添加、删除、更新DOM节点
    - 通过display: none隐藏一个DOM节点-触发重排和重绘
    - 通过visibility: hidden隐藏一个DOM节点-只触发重绘，因为没有几何变化
    - 移动或者给页面中的DOM节点添加动画
    - 添加一个样式表，调整样式属性
    - 用户行为，例如调整窗口大小，改变字号，或者滚动
-  如何避免重绘或者重排？
    - 集中改变样式
     ```
        // 判断是否是黑色系样式
        const theme = isDark ? 'dark' : 'light'

        // 根据判断来设置不同的class
        ele.setAttribute('className', theme)
     ```
    - DocumentFragment
        通过createDocumentFragment创建一个游离于DOM树之外的节点，然后在此节点上批量操作，最后插入DOM树中，因此只触发一次重排
        