<template>
    <el-menu default-active="2" background-color="#263238" text-color="#fff" active-text-color="#ffd04b" width="220px" unique-opened router >
        <el-menu-item index="-1" disabled>UI 示例</el-menu-item>
        <el-submenu index="1">
            <template slot="title">
                <i class="ele-my-layout"></i>
                <span>布局</span>
            </template>
            <el-submenu index="1-1">
                <template slot="title">栅格</template>
                <el-menu-item index="index">基本栅格</el-menu-item>
                <el-menu-item index="user">布局栅格</el-menu-item>
            </el-submenu>
            <el-submenu index="1-2">
                <template slot="title">标题栏</template>
                <el-menu-item index="index">普通</el-menu-item>
                <el-menu-item index="user">带边框</el-menu-item>
            </el-submenu>
            <el-menu-item index="1-3">面板动画</el-menu-item>
            <el-menu-item index="1-4">盒式布局</el-menu-item>
            <el-menu-item index="1-5">侧边栏</el-menu-item>
            <el-menu-item index="1-6">两栏式布局</el-menu-item>
        </el-submenu>
        <el-submenu index="2">
            <template slot="title">
                <i class="ele-my-lifangtilitiduomiantifangkuai"></i>
                <span>基本</span>
            </template>
            <el-submenu index="2-1">
                <template slot="title">面板</template>
                <el-menu-item index="index">面板结构</el-menu-item>
                <el-menu-item index="user">面板操作</el-menu-item>
            </el-submenu>
            <el-menu-item index="2-2">面板组件</el-menu-item>
            <el-menu-item index="1-4">按钮</el-menu-item>
            <el-menu-item index="1-5">矢量图标</el-menu-item>
            <el-menu-item index="1-6">下拉菜单</el-menu-item>
        </el-submenu>
    </el-menu>
</template>
    
<script>
    export default {
        data() {
            return {};
        }
    }
</script>