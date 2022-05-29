<template>
 <div>
     <v-app>
         <v-app-bar
             app



         >
             <v-toolbar dense flat>
                 <v-toolbar-title><a href="http://" class="navbar-brand"><span class="font-weight-light">BLOG</span><span CLASS="logo_span">ADDICT</span></a></v-toolbar-title>

                 <v-spacer></v-spacer>

                 <v-btn icon>
                     <v-icon>mdi-magnify</v-icon>
                 </v-btn>

                 <v-btn icon>
                     <v-icon>mdi-heart</v-icon>
                 </v-btn>

                 <v-btn icon>
                     <v-icon>mdi-dots-vertical</v-icon>
                 </v-btn>
             </v-toolbar>
             <v-avatar
                 color="primary"
                 size="30"
             >
                 <v-icon dark>
                     mdi-account-circle
                 </v-icon>
             </v-avatar>

             <v-btn  color="primary" ms-2>
                 Register
             </v-btn>
         </v-app-bar>
         <div class="container-fluid mt-5">
             <div class="row">
                 <div class="col-md-2"> </div>
                 <div class="col-md-6">
                    <div class="card border-0 shadow-md py-5">
                        <div class="card-body">
                            <div class="card-header bg-transparent"><h2 class="text-muted text-center">Register</h2></div>
                            <input type="text" v-model="register.name" class="form-control mb-2 " placeholder="name">
                            <input type="text" v-model="register.email" class="form-control mb-2" placeholder="email">
                            <input type="text" v-model="register.password" class="form-control mb-2" placeholder="password">
                            <input type="button" @click="registerUser" class="btn btn-primary w-100 mb-2 shadow-sm" value="Register" >
                        </div>
                    </div>
                 </div>
                 <div class="col-md-2"> </div>
             </div>
         </div>

         <div class="container-fluid mt-5">
             <div class="row">
                 <div class="col-md-2"> </div>
                 <div class="col-md-6">
                     <div class="card border-0 shadow-md py-5">
                         <div class="card-body">
                             <div class="card-header bg-transparent"><h2 class="text-muted text-center">Login</h2></div>
<!--                             <input type="text" v-model="register.name" class="form-control mb-2 " placeholder="name">-->
                             <input type="text" v-model="login.email" class="form-control mb-2" placeholder="email">
                             <input type="text" v-model="login.password" class="form-control mb-2" placeholder="password">
                             <input type="button" @click="loginUser" class="btn btn-primary w-100 mb-2 shadow-sm" value="login" >
                         </div>
                     </div>
                 </div>
                 <div class="col-md-2"> </div>
             </div>
         </div>
<!--       <v-container>-->
<!--           <v-row>-->
<!--               <v-col cols="12" sm="6">-->
<!--                   <v-card  px-5>-->
<!--                       <v-card-title>Register</v-card-title>-->
<!--                       <v-text-field-->
<!--                           v-model="register.name"-->
<!--                           color="blue darken-2"-->
<!--                           label="Name"-->
<!--                           required-->
<!--                       >-->

<!--                       </v-text-field>-->
<!--                       <v-text-field-->
<!--                           v-model="register.email"-->
<!--                           color="blue darken-2"-->
<!--                           label="Email"-->
<!--                           required-->
<!--                       >-->

<!--                       </v-text-field>-->
<!--                       <v-text-field-->
<!--                           v-model="register.password"-->
<!--                           color="blue darken-2"-->
<!--                           label="password"-->
<!--                           required-->
<!--                       >-->

<!--                       </v-text-field>-->
<!--                       <v-btn @click="registerUser">-->
<!--                           Submit-->
<!--                       </v-btn>-->
<!--                   </v-card>-->
<!--               </v-col>-->
<!--           </v-row>-->
<!--       </v-container>-->
     </v-app>
 </div>
</template>

<script>
export default {
    name: 'aboutComponent',

    data: ()=>{
        return {
            products: [],
            register: {
                name: "",
                email: "",
                password: ""
            },
            login: {
                email: "",
                password: ""
            }
        }
    },

    mounted(){
        this.getProducts();
        this.getUserProducts();
    },
    methods: {

        registerUser: function (){
            axios.post('/api/register' , this.register)
            .then(response => {
              //  console.log(response)
                alert('Registered')
            })
        },

        loginUser: function (){


            axios.get('/sanctum/csrf-cookie').then(response => {
                // Login...
                axios.post('/api/login' , this.login)
                    .then(response => {
                        console.log(response)
                        console.log(response.data.data.id)
                       // this.getProducts();
                        localStorage.setItem('token', response.data.token);
                        localStorage.setItem('id' , response.data.data.id);
                        //alert('Registered')
                    })
            });

        },

        getProducts: function(){
           // let self = this;
            let token = localStorage.getItem('token')
            let user_id = localStorage.getItem('id');
            axios.get('/api/products/' , {headers: {"Authorization": `Bearer ${token}`}})
                .then((response) =>
                    // self.products = response.data.data
                    console.log(response)
                )
                .catch((error) => {
                    // handle error
                    console.log(error);
                })

        },

        getUserProducts: function(){
            // let self = this;
            let token = localStorage.getItem('token')
            let user_id = localStorage.getItem('id');
            axios.get('/api/products/' + user_id , {headers: {"Authorization": `Bearer ${token}`}})
                .then((response) =>
                    // self.products = response.data.data
                    console.log(response)
                )
                .catch((error) => {
                    // handle error
                    console.log(error);
                })

        },
    }

}
</script>
<style>
.navbar-brand{
    color: black;
    font-weight: 500;
}
.logo_span{
    color: midnightblue;
}
</style>
