# webpack相关知识点
- [Dllplugin](https://juejin.im/post/5d897e3cf265da03c721e230) 解决打包速度过慢
    + CommonsChunkPlugin webpack 每次打包实际还是需要去处理这些第三方库，只是打包完之后，能把第三方库和我们自己的代码分开
    + DLLPlugin 而 DLLPlugin 则是能把第三方代码完全分离开，即每次只打包项目自身的代码。Dll这个概念是借鉴了Windows系统的dll，一个dll包，就是一个纯纯的依赖库，它本身不能运行，是用来给你的app引用的。
    打包dll的时候，Webpack会将所有包含的库做一个索引，写在一个manifest文件中，而引用dll的代码（dll user）在打包的时候，只需要读取这个manifest文件，就可以了。
        - 需要额外的webpack.dll.config.js配置文件
        ```
        const path    = require('path');
        const webpack = require('webpack');
        module.exports = {
        entry: {
            vendor: ['vue-router','vuex','vue/dist/vue.common.js','vue/dist/vue.js','vue-loader/lib/component-normalizer.js','vue']
        },
        output: {
            path: path.resolve('./dist'),
            filename: '[name].dll.js',
            library: '[name]_library'
        },
        plugins: [
            new webpack.DllPlugin({
            path: path.resolve('./dist', '[name]-manifest.json'),
            name: '[name]_library'
            })
        ]
        };
        ```
- externals 选项
  让webpack不打包某部分，然后在其他地方引入cdn上的js文件，利用缓存下载cdn文件达到减少打包时间的目的。 配置externals选项;

- Webpack热更新实现原理
    1. Webpack编译期，为需要热更新的 entry 注入热更新代码(EventSource通信)
    2. 页面首次打开后，服务端与客户端通过 EventSource 建立通信渠道，把下一次的 hash 返回前端
    3. 客户端获取到hash，这个hash将作为下一次请求服务端 hot-update.js 和 hot-update.json的hash
    4. 修改页面代码后，Webpack 监听到文件修改后，开始编译，编译完成后，发送 build 消息给客户端
    5. 客户端获取到hash，成功后客户端构造hot-update.js script链接，然后插入主文档
    6. hot-update.js 插入成功后，执行hotAPI 的 createRecord 和 reload方法，获取到 Vue 组件的 render方法，重新 render 组件， 继而实现 UI 无刷新更新。

- sideEffects
    1. package.json和webpack配置文件中的sideEffects虽然同名，但表示的意义不同。package.json的sideEffects：标识当前package.json所影响的项目，当中所有的代码是否有副作用默认true，表示当前项目中的代码有副作用webpack配置文件中的sideEffects：开启功能，是否移除无副作用的代码默认false，表示不移除无副作用的模块在production模式下自动开启。webpack不会识别代码是否有副作用，只会读取package.json的sideEffects字段。二者需要配合使用，才能处理无副作用的模块。
