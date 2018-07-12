<template>
    <el-container class="full_win">
        <el-header height="60px" class="top_menu">
            <el-container>
                <el-aside width="220px" class="top_menu_title">管理后台</el-aside>
                <el-main>
                    
                </el-main>
                <el-aside width="160px" class="right_ctrl">
                    <el-row>
                        <el-col :span="9">
                            <el-popover placement="bottom" width="400" trigger="click" offset="20">
                                <el-table :data="gridData">
                                    <el-table-column width="150" property="date" label="日期"></el-table-column>
                                    <el-table-column width="100" property="name" label="姓名"></el-table-column>
                                    <el-table-column width="300" property="address" label="地址"></el-table-column>
                                </el-table>
                                <el-badge :value="12" class="item" slot="reference">
                                    <i class="el-icon-bell ctrl_icon"></i>
                                </el-badge>
                            </el-popover>
                        </el-col>
                        <el-col :span="7">
                                <i class="ele-my-user ctrl_icon"></i>
                        </el-col>
                        <el-col :span="7">
                                <router-link to="/login">
                                    <i class="ele-my-logout ctrl_icon"></i>
                                </router-link>
                        </el-col>
                    </el-row>
                </el-aside>
            </el-container>
        </el-header>
        <el-container class="full_win">
            <el-aside class="left_menu" width="220px">
                <router-view name="menu"></router-view>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
export default {
    data() {
        return {
            activeIndex: '1',
            gridData: [{
              date: '2016-05-02',
              name: '王小虎',
              address: '上海市普陀区金沙江路 1518 弄'
            }, {
              date: '2016-05-04',
              name: '王小虎',
              address: '上海市普陀区金沙江路 1518 弄'
            }, {
              date: '2016-05-01',
              name: '王小虎',
              address: '上海市普陀区金沙江路 1518 弄'
            }, {
              date: '2016-05-03',
              name: '王小虎',
              address: '上海市普陀区金沙江路 1518 弄'
            }]
        };
    },
    methods: {
        handleSelect(key, keyPath) {
            console.log(key, keyPath);
        }
    }
}
</script>
<style>
    .top_menu{
        padding:0px;
        background:#4e97d9;
    }
    .top_menu .el-container .el-aside{
        height:60px;
    }
    .top_menu .el-container .el-main{
        padding:0px;
    }
    .top_menu .el-container .el-aside.top_menu_title{
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
    .top_menu .el-menu{
        background:#4e97d9;
    }
    .top_menu .el-menu .el-menu-item{
        color:#FFFFFF;
        border-bottom:0px;
    }
    .top_menu .el-menu .el-menu-item i{
        color:#FFFFFF;
    }
    .top_menu .el-menu .el-menu-item.is-active,.top_menu .el-menu .el-menu-item:focus,.top_menu .el-menu .el-menu-item:hover{
        background-color: rgba(0,0,0,.1);
        color:#FFFFFF;
        border-bottom:0px;
    }
    .top_menu .el-menu .el-submenu{
        background-color:#4e97d9;
    }
    .top_menu .el-menu .el-submenu:focus .el-submenu__title,.top_menu .el-menu .el-submenu:hover .el-submenu__title{
        background-color: rgba(0,0,0,.1);
        color:#FFFFFF;
        border-bottom:0px;
    }
    .top_menu .el-menu .el-submenu .el-submenu__title{
        border-bottom:0px;
    }
    .top_menu .el-menu .el-submenu .el-submenu__title i{
        color:#FFFFFF;
    }
    .top_menu .el-menu .el-submenu .el-submenu__title .el-submenu__icon-arrow.el-icon-arrow-down{
        display:none;
    }
    .full_win.el-container{
        height:100%;
    }
    @media only screen and (max-width:1415px){
        .right_ctrl {
            display:none !important;
        }
    }
    .right_ctrl {
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: stretch;
    }
    .right_ctrl .el-row{
        flex:1;
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: stretch;
    }
    .right_ctrl .el-row .el-col{
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
    .right_ctrl .ctrl_icon{
        color:#FFFFFF;
        font-size:20px;
    }
    .left_menu{
        background: #263238;
        height:100%;
    }
    .left_menu .el-menu{
        border:0px;
    }

</style>