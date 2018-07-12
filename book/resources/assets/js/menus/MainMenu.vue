<template>
    <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect" router>
        <el-menu-item index="1"><i class="el-icon-view"></i><span>UI 示例</span></el-menu-item>
        <el-menu-item index="2"><i class="el-icon-printer"></i><span>页面示例</span></el-menu-item>
        <el-menu-item index="3"><i class="el-icon-date"></i><span>表格示例</span></el-menu-item>
        <el-menu-item index="4"><i class="el-icon-tickets"></i><span>表单示例</span></el-menu-item>
        <el-menu-item index="5"><i class="el-icon-time"></i><span>统计图表</span></el-menu-item>
        <el-menu-item index="6"><i class="el-icon-menu"></i><span>菜单示例</span></el-menu-item>
        <el-menu-item index="7"><i class="el-icon-setting"></i><span>系统管理</span></el-menu-item>
    </el-menu>
</template>
    
<script>
    export default {
        data() {
            return {};
        }
    }
</script>
