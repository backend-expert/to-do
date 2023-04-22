<template>
    <div>
        <!-- <LoginMenu /> -->
        <h1>Login</h1>

        <!-- <ValidationObserver
            ref="loginForm"
            tag="form"
            @submit.stop.prevent="login()"
        > -->

        <form @submit.stop.prevent="login()" >


        <div>
            <label for="">Email</label> <br>

            <!-- <ValidationProvider
                v-slot="{errors}"

                immediate
                rules="secret"  
                 
            > -->
         
            <!-- <span>{{ errors[0] }}</span> -->
                <input
                    v-model="email"
                    placeholder="Digite seu Email"
                    type="text"
                />
            <!-- </ValidationProvider> -->
        </div>

        <div>
            <label for="">Password</label> <br>
            <input
                v-model="password"
                placeholder="Password" 
                type="text"
                />
        </div>

        <div>
            <button
          
          type="submit" 
                
         
            >Entrar</button>
        </div>
        </form>
    
        <!-- </ValidationObserver> -->
    </div>
</template>


<script>
// import LoginMenu from '@/components/Auth/LoginMenu';

import axios from '@/plugins/axios';
import Cookie from 'js-cookie';
// import { ValidationObserver, ValidationProvider,  extend  } from 'vee-validate';

export default {
    name: 'Login',

    components: {
        // LoginMenu,
   
    },

    

    data() {
       // Defining the initial state of the component's data properties `email` and `password` as empty
       // strings.
        return {
            email:'',
            password:''
        };
    },

    methods: {
        // async 
        login() {
            // await this.$refs.loginForm.validate();
            

            // console.log('login');
            // return ;

            const payload = {
                email: this.email,
                password: this.password
            };

            //conexao ajax
            axios.post('/login', payload).then((response) => {
     const token = `${response.data.token_type} ${response.data.access_token}`; 

                Cookie.set('_todolist_token', token, {
                    expires:30
                });

                   this.$store.commit('user/STORE_USER', response.data.data);
            });

        },
    },
}
</script>
<style>
    
</style>