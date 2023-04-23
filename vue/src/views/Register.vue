<template>
  
        <main class="form-signin w-100 m-auto">


        <form @submit.prevent="onSubmitRegister()">
            <img class="mb-4" src="@/assets/images/logo.png" alt="" width="72" height="57">

            <div>
                  <strong class="w-100 h3 mb-3 fw-normal">Cadastrar Novo Usuário</strong>
            </div>
          

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

            <div class="form-floating">
                
                <input 
                    v-model="name"
                    type="text" 
                    class="form-control" 
                    id="floatingInput" 
                    placeholder="nome"
                >
                <label for="floatingInput">Nome</label>
            </div> <br>

            <div class="form-floating">
                
                <input 
                    v-model="lastName"
                    type="text" 
                    class="form-control" 
                    id="floatingInput" 
                    placeholder="last name"
                >
                <label for="floatingInput">sobrenome</label>
            </div> <br>

            <div class="form-floating">
                
                <input 
                    v-model="email"
                    type="email" 
                    class="form-control" 
                    id="floatingInput" 
                    placeholder="name@example.com"
                >
                <label for="floatingInput">Email address</label>
            </div> <br>

            <div class="form-floating">

                <input 
                    v-model="password"
                    type="text" 
                    class="form-control" 
                    id="floatingPassword" 
                    placeholder="Password"
                >
                <label for="floatingPassword">Password</label>
            </div> <br>          
           
            <button 
                class="w-100 btn btn-lg btn-primary" 
                type="submit"
            >
            <div   
                v-if="spinner.register" 
                class="spinner-border text-warning" role="status"
            >
                <span class="visually-hidden">Loading...</span>
            </div>
            <!-- <img 
                v-if="spinner.register"
                src="@/assets/images/icons8-spinner.gif" alt=""
            > -->
                Enviar
            </button>
           
        </form>
        </main>
     <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
</template>
<script>
import axios from '@/plugins/api';
import _messages from '@/helpers/messages';

export default {
    name:'Register',
    components:{ },

    data() {

        return {

            name:'',
            lastName:'',
            email:'',
            password:'',

            _response: {
                    color: '',
                    message:'',
                },
            spinner: {
                register: false
            }, 

        };
    },

    methods: {
        async onSubmitRegister() {
            const payload = {
                first_name: this.name,
                last_name: this.lastName,
                email:this.email,
                password:this.password,
            };

            this.resetResponse();

            this.spinner.register = true;

            axios.post('/register', payload).then(() => {
                
                this._response.color = 'green';
                this._response.message = 'Usuário cadastrado com sucesso!';

                this.resetForm();

            }).catch((error) => {
                
                const errorCode = error?.response?.data?.error || 'ServerError';

                this._response.color = 'red',
                this._response.message = _messages[errorCode]

            }).finally(() => {
                this.spinner.register = false;
            });
        },

        resetResponse() {
            this._response.color ='';
            this._response.message ='';
        },

        resetForm() {
            this.name='';
            this.lastName='';
            this.email='';
            this.password='';
        }
    }
    
}
</script>
<style >
    

.form-signin {
  max-width: 330px;
  padding: 15px;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>