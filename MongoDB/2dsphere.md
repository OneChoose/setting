# 创建2dsphere索引
  ` db.sphere.ensureIndex({"sp":"2dsphere"})
 
# 插入Point数据
  * db.sphere.insert({name:"A",sp:{type:"Point",coordinates:[105.754484701156,41.689607057699]}})
  * db.sphere.insert({name:"B",sp:{type:"Point",coordinates:[105.304045248031,41.783456183240]}})
  * db.sphere.insert({name:"C",sp:{type:"Point",coordinates:[105.084318685531,41.389027478812]}})
  * db.sphere.insert({name:"D",sp:{type:"Point",coordinates:[105.831388998031,41.285916385493]}})
  * db.sphere.insert({name:"E",sp:{type:"Point",coordinates:[106.128706502914,42.086868474465]}})
  * db.sphere.insert({name:"F",sp:{type:"Point",coordinates:[105.431074666976,42.009365053841]}})
  * db.sphere.insert({name:"G",sp:{type:"Point",coordinates:[104.705977010726,41.921549795110]}})


##（1）geoNear:我们要查询的集合名称 
##（2）near:就是基于那个点进行搜索，这里是我们的搜索点A 
##（3）spherical:是个布尔值，如果为true，表示将计算实际的物理距离比如两点之间有多少km,若为false,则会基于点的单位进行计算 
##（4）minDistance:搜索的最小距离，这里的单位是米 
##（5）maxDistance:搜索的最大距离
* db.runCommand({
*   geoNear:"sphere",
*   near:{type:"Point",coordinates:[105.794621276855,41.869574065014]},
*   spherical:true,
*   minDistance:25000,
*   maxDistance:40000,
* })
