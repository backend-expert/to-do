<template>
    <div>
        <!-- <LoginMenu /> -->
        <h1>Login</h1>

        <div
            v-if="_response.message"
            :class="`${_response.color}`"
        >
        <h3
        :class="`${_response.color}`"
        >
            {{ _response.message }}
        </h3>

        </div>

        <form @submit.prevent="login()" >
        <div>
            <label for="">Email</label> <br>
          
                <input
                    v-model="email"
                    placeholder="Digite seu Email"
                    type="text"
                />
         
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
                :disabled="spinner.login"
                >
                <img 
                    v-if="spinner.login"
                    src="@/assets/images/icons8-spinner.gif" alt=""
                    >
                Entrar
            </button>
        </div>
        </form>
    
    </div>
</template>


<script>
// import LoginMenu from '@/components/Auth/LoginMenu';


import axios from '@/plugins/api';
import Cookie from 'js-cookie';
import message from '@/helpers/messages';

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
            password:'',
            _response: {
                color: '',
                message:'',
            },
            spinner: {
                login: false
            },
        };
    },

    methods: {
       
        login() {
         

            const payload = {
                email: this.email,
                password: this.password
            };

           // `this.resetResponse();` is calling the `resetResponse()` method defined in the
           // component's `methods` object. This method is used to reset the `_response` object's
           // `color` and `message` properties to empty strings, which is used to clear any previous
           // error or success messages displayed on the login form.
            this.resetResponse();

            this.spinner.login = true;
            
            axios.post('/login', payload).then((response) => {
            
                const token = `${response.data.token_type} ${response.data.access_token}`; 

                Cookie.set('_todolist_token', token, {
                    expires:30
                });

                   this.$store.commit('user/STORE_USER', response.data.data);
                }).catch((error) => {
                    this.spinner.login = false;

                    const errorCode = error?.response?.data?.error || 'ServerError';
                    this._response.color = 'red',
                    this._response.message = message[errorCode]
                   
                });
            
            
                // .catch(() => {
                //     this._response.color = 'red',
                //     this._response.message = 'Ops! E-mail e/ou senha inválidos.'
                //     // console.log('error');
                // });

        },

        resetResponse() {
            this._response.color = '',
            this._response.message = ''
        },
    },
}
</script>
<style>
    
</style>