# 创建2dsphere索引
    db.sphere.ensureIndex({"sp":"2dsphere"})
 
# 插入Point数据
    db.sphere.insert({name:"重庆",sp:{type:"Point",coordinates:[106.548089,29.573017]}})
    db.sphere.insert({name:"龙头寺",sp:{type:"Point",coordinates:[106.561887,29.595129]}})
    db.sphere.insert({name:"沙坪公园",sp:{type:"Point",coordinates:[106.561887,29.595129]}})
    db.sphere.insert({name:"照母山",sp:{type:"Point",coordinates:[106.50727,29.629292]}})
    db.sphere.insert({name:"南岸",sp:{type:"Point",coordinates:[106.668821,29.504137]}})
    db.sphere.insert({name:"璧山",sp:{type:"Point",coordinates:[106.521068,29.588596]}})
    db.sphere.insert({name:"中央公园",sp:{type:"Point",coordinates:[106.668821,29.504137]}})
    db.sphere.insert({name:"江津",sp:{type:"Point",coordinates:[106.259481,29.298727]}})

# 查询
    （1）geoNear:我们要查询的集合名称 
    （2）near:就是基于那个点进行搜索，这里是我们的搜索点A 
    （3）spherical:是个布尔值，如果为true，表示将计算实际的物理距离比如两点之间有多少km,若为false,则会基于点的单位进行计算 
    （4）minDistance:搜索的最小距离，这里的单位是米 
    （5）maxDistance:搜索的最大距离
    （6）limit 

    db.runCommand({
        geoNear:"sphere",
        near:{type:"Point",coordinates:[106.548089,29.573017]},
        spherical:true,
        minDistance:0,
        maxDistance:3000,
        })

# 结果
### * dis 表示距离多少米
    {
    	"results" : [
    		{
    			"dis" : 0,
    			"obj" : {
    				"_id" : ObjectId("5b0686b45e5be25b1e0fb094"),
    				"name" : "重庆",
    				"sp" : {
    					"type" : "Point",
    					"coordinates" : [
    						106.548089,
    						29.573017
    					]
    				}
    			}
    		},
    		{
    			"dis" : 2800.550696958594,
    			"obj" : {
    				"_id" : ObjectId("5b0686b45e5be25b1e0fb095"),
    				"name" : "龙头寺",
    				"sp" : {
    					"type" : "Point",
    					"coordinates" : [
    						106.561887,
    						29.595129
    					]
    				}
    			}
    		},
    		{
    			"dis" : 2800.550696958594,
    			"obj" : {
    				"_id" : ObjectId("5b0686b45e5be25b1e0fb096"),
    				"name" : "沙坪公园",
    				"sp" : {
    					"type" : "Point",
    					"coordinates" : [
    						106.561887,
    						29.595129
    					]
    				}
    			}
    		}
    	],
    	"stats" : {
    		"nscanned" : 46,
    		"objectsLoaded" : 4,
    		"avgDistance" : 1867.033797972396,
    		"maxDistance" : 2800.550696958594,
    		"time" : 1
    	},
    	"ok" : 1
    }
