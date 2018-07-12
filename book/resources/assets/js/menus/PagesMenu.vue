<template>
    <el-menu default-active="2" background-color="#263238" text-color="#fff" active-text-color="#ffd04b" width="220px" unique-opened router >
        <el-menu-item index="-1" disabled>UI 示例</el-menu-item>
        <el-submenu index="1">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span>导航一</span>
            </template>
            <el-menu-item index="index">基本栅格</el-menu-item>
            <el-menu-item index="user">布局栅格</el-menu-item>
            <el-menu-item index="1-3">选项3</el-menu-item>
            <el-menu-item index="1-4">选项4</el-menu-item>
            <el-menu-item index="1-5">选项5</el-menu-item>
            <el-menu-item index="1-6">选项6</el-menu-item>
        </el-submenu>
        <el-submenu index="2">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span>导航二</span>
            </template>
            <el-menu-item-group>
                <template slot="title">分组一</template>
                <el-menu-item index="2-1">选项1</el-menu-item>
                <el-menu-item index="2-2">选项2</el-menu-item>
            </el-menu-item-group>
            <el-menu-item-group title="分组2">
                <el-menu-item index="2-3">选项3</el-menu-item>
            </el-menu-item-group>
            <el-submenu index="2-4">
                <template slot="title">选项4</template>
                <el-menu-item index="2-4-1">选项1</el-menu-item>
            </el-submenu>
        </el-submenu>
        <el-submenu index="3">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span>导航三</span>
            </template>
            <el-menu-item index="3-1">选项1</el-menu-item>
            <el-menu-item index="3-2">选项2</el-menu-item>
            <el-menu-item index="3-3">选项3</el-menu-item>
            <el-menu-item index="3-4">选项4</el-menu-item>
            <el-menu-item index="3-5">选项5</el-menu-item>
            <el-menu-item index="3-6">选项6</el-menu-item>
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