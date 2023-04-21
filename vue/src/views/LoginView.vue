<template>
    <div>
        <!-- <LoginMenu /> -->
        <h1>Login</h1>

        <div>
            <label for="">Email</label> <br>
            <input
                v-model="email"
                placeholder="Email"
                type="email"
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
            @click.prevent="login()"
            >Entrar</button>
        </div>
    </div>
</template>
<script>
// import LoginMenu from '@/components/Auth/LoginMenu';
import axios from '@/plugins/axios';
import Cookie from 'js-cookie';

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
        login() {
            const payload = {
                email: this.email,
                password: this.password
            };

            //conexao ajax
            axios.post('/login', payload).then((response) => {

                // `const token = `${response.data.token_type} ${response.data.access_token}`;` is
                // creating a string that concatenates the `token_type` and `access_token` values from
                // the `response.data` object returned by the server after a successful login request.
                // This string represents the authentication token that will be used to authenticate
                // subsequent requests to the server.
                const token = `${response.data.token_type} ${response.data.access_token}`; 

                Cookie.set('_todolist_token', token, {
                    expires:30
                });

                // `this..commit('user/STORE_USER', response.data.data)` is committing a mutation
                // called `STORE_USER` to the Vuex store's `user` module. The mutation is passing
                // `response.data.data` as the payload, which will update the state of the `user`
                // module with the new user data.
                this.$store.commit('user/STORE_USER', response.data.data);
            });

        },
    },
}
</script>
<style>
    
</style>