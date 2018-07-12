<template>
    <div class="page_full">
      <div class="page_left hidden-xs-only">
        <div class="info">
            用ElementUI 模仿Admui
        </div>
      </div>
      <div class="page_right">
        <div class="login_box">
            <el-form ref="form" :model="form" :rules="rules">
                <el-form-item class="title_item1 hidden-xs-only">
                    <h3>登录Admui</h3>
                    <p>Admui在线演示系统</p>
                </el-form-item>

                <el-form-item class="title_item2 hidden-sm-and-up">
                    <h3>管理后台</h3>
                </el-form-item>

                <el-form-item prop="account">
                    <el-input v-model="form.account" placeholder="请输入帐号"></el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input v-model="form.password" type="password" placeholder="请输入密码"></el-input>
                </el-form-item>

                <el-form-item prop="code">
                    <el-input placeholder="请输入验证码" v-model="form.code">
                        <template slot="append" width="120px">隐藏的验证码</template>
                    </el-input>
                </el-form-item>

                <el-form-item>
                    <el-checkbox v-model="form.auto_login">自动登录</el-checkbox>
                    <p class="reg">
                        <a href="#">注册帐号</a>
                        <a href="#">找回密码</a>
                    </p>
                </el-form-item>
                
                <el-form-item>
                    <el-button type="primary" @click="onSubmit" class="sub_btn">立即登录</el-button>
                </el-form-item>
            </el-form>
        </div>
      </div>
    </div>
</template>
    
<script>
    export default {
        data() {
            return {
                form: {
                    account: '',
                    password: '',
                    code: '',
                    auto_login: false,
                },
                rules: {
                    account: [
                        { required: true, message: '请输入帐号', trigger: 'blur' },
                        { min: 6,  message: '帐号错误', trigger: 'blur' }
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' },
                        { min: 6, max:18, message: '密码长度必须是6-18位', trigger: 'blur' }
                    ],
                    code: [
                        { required: true, message: '请输入验证码', trigger: 'blur' },
                        { min: 4, max:6, message: '验证码错误', trigger: 'blur' }
                    ],
                }
            }
        },
        methods: {
            onSubmit() {
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        console.log(this.form);
                        this.$router.push('/')
                    }else{
                        console.log('error submit!!');
                        return false;
                    }
                });
            }
        }
    }
</script>
<style>
    .page_full{
        width:100%;
        height:100%;
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: flex-start;
    }
    .page_left{
        flex-grow:99;
        height: 100%;
        background:#EEEEEE;
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
    .page_left .info{
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
    .page_right{
        flex-grow:1;
        background:#FFFFFF;
        height:100%;
        min-height:600px;
        padding: 0 60px;
    }
    .page_right .login_box{
        height:100%;
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
    .page_right .login_box .el-form{
        width:350px;
    }
    @media only screen and (max-width:767px){
        .page_right .login_box .el-form {
            width: auto;
        }
    }
    .sub_btn{
        width:100%;
    }
    p.reg{
        display: inline-block;
        position: relative;
        white-space: nowrap;
        float: right;
    }
    p.reg a{
        margin-left:5px;
        color: #62a8ea;
        text-decoration: none;
    }
    .title_item1 h3{
        color:#37474f;
    }
    .title_item1 p{
        color:#76838f;
    }
    .title_item2 h3{
        text-align:center;
        font-size:24px;
    }
</style>