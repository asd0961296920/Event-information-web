let routes = [
    '/', '/city', '/page','/city', '/page'
  ]
  for (let i = 1; i <= 22; i++) {
    routes.push(`/city/${i}`);
}


  const SitemapWebpackPlugin = require('sitemap-webpack-plugin').default;

module.exports = {
    transpileDependencies: ["@vueform"],
    
configureWebpack: {
    plugins: [
      new SitemapWebpackPlugin({
        base: 'https://twgather.techscomet.com',
        paths: routes,
        options: {
          //生成的站点地图文件名
          filename: 'sitemap.xml',
          // lastMod属性是否开启
          lastMod: true,
          // 更新频率
          changefreq: 'monthly'
        }
      })
    ]
  }
}



// config.plugin("sitemap").use(sitemapWebpackPlugin, [
//     {
//       base: 'https://twgather.techscomet.com',
//       paths: routes,
//       options: {
//         //生成的站点地图文件名
//         filename: 'sitemap.xml',
//         // lastMod属性是否开启
//         lastMod: true,
//         // 更新频率
//         changefreq: 'monthly'
//       },
//     }
//   ])
