## 返回上一步操作
    git reset --hard 2e06dc9 ##2e06dc9上一次操作的版本号

## 通过git config可以查看配置信息
    $ git config --list
    core.symlinks=false
    core.autocrlf=true
    core.fscache=true
    color.diff=auto
    color.status=auto
    color.branch=auto
    color.interactive=true
    pack.packsizelimit=2g
    help.format=html
    http.sslcainfo=d:/Program Files (x86)/Git/mingw32/ssl/certs/ca-bundle.crt
    diff.astextplain.textconv=astextplain
    rebase.autosquash=true
    user.email=1812587695@qq.com
    user.name=大人物
    core.repositoryformatversion=0
    core.filemode=false
    core.bare=false
    core.logallrefupdates=true
    core.symlinks=false
    core.ignorecase=true
    remote.origin.url=http://username:password@115.28.103.142:3000/zhangyu/yc3.0.git
    remote.origin.fetch=+refs/heads/*:refs/remotes/origin/*
    branch.master.remote=origin
    branch.master.merge=refs/heads/master

## 设置用户名密码
    git remote set-url origin http://username:password@115.28.103.142:3000/zhangyu/yc3.0.git http://115.28.103.142:3000/zhangyu/yc3.0.git

## 基本命令
    Git基本常用命令如下：

   mkdir：         XX (创建一个空目录 XX指目录名)

   pwd：          显示当前目录的路径。

   git init          把当前的目录变成可以管理的git仓库，生成隐藏.git文件。

   git add XX       把xx文件添加到暂存区去。

   git commit –m “XX”  提交文件 –m 后面的是注释。

   git status        查看仓库状态

   git diff  XX      查看XX文件修改了那些内容

   git log          查看历史记录

   git reset  –hard HEAD^ 或者 git reset  –hard HEAD~ 回退到上一个版本

                        (如果想回退到100个版本，使用git reset –hard HEAD~100 )

   cat XX         查看XX文件内容

   git reflog       查看历史记录的版本号id

   git checkout — XX  把XX文件在工作区的修改全部撤销。

   git rm XX          删除XX文件

   git remote add origin https://github.com/tugenhua0707/testgit 关联一个远程库

   git push –u(第一次要用-u 以后不需要) origin master 把当前master分支推送到远程库

   git clone https://github.com/tugenhua0707/testgit  从远程库中克隆

   git checkout –b dev  创建dev分支 并切换到dev分支上

   git branch  查看当前所有的分支

   git checkout master 切换回master分支

   git merge dev    在当前的分支上合并dev分支

   git branch –d dev 删除dev分支

   git branch name  创建分支

   git stash 把当前的工作隐藏起来 等以后恢复现场后继续工作

   git stash list 查看所有被隐藏的文件列表

   git stash apply 恢复被隐藏的文件，但是内容不删除

   git stash drop 删除文件

   git stash pop 恢复文件的同时 也删除文件

   git remote 查看远程库的信息

   git remote –v 查看远程库的详细信息

   git push origin master  Git会把master分支推送到远程库对应的远程分
   
## gitignore不起作用的解决方法，手动创建[.gitignore]
    git rm -r --cached .
    git add .
    git commit -m 'update .gitignore'

## 将服务器代码更新到本地
    git checkout .
    
## 删除远程服务器分支
    git push origin --delete yc3.0  yc3.0是远程分支
    
## .gitignore规则不生效的解决办法
    git rm -r --cached .
    git add .
    git commit -m 'update .gitignore'
    
## 错误解决：error: Untracked working tree file 'public/images/icon.gif' would be overwritten by merge.
    git reset --hard HEAD    
    git clean -f -d    
    git pull
    
