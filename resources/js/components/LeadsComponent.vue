<template>
    <div>
        <loading :active.sync="isLoading"
                 :is-full-page="true"></loading>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Тел</th>
                <th scope="col">Email</th>
                <th scope="col">Тип кузова</th>
                <th scope="col">Марка</th>
                <th scope="col">Модель</th>
                <th scope="col">Дата & Время</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(lead,key) in leadsDraw">
                    <th scope="row">{{key+1}}</th>
                    <td> {{lead.lead_name}}</td>
                    <td> {{lead.lead_phone}}</td>
                    <td> {{lead.lead_mail}}</td>
                    <td> {{lead.autoria.car_category}}</td>
                    <td> {{lead.autoria.car_mark}}</td>
                    <td> {{lead.autoria.car_model}}</td>
                    <td> {{lead.created_at}}</td>
                    <td><a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="removeLead(lead)"><i class="fa fa-times" aria-hidden="true"></i></a> </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate'

    export default {
        name: "leads-component",
        props:[
            'leads',
        ],
        data: function () {
            return {
                leadsDraw: []
            }
        },
        methods:{
            removeLead(leadObject){

                this.makeAjaxCall(leadObject.destroy_link, 'DELETE', {_token: this.token})
                    .then(response => this.leadsDraw = response.data)

            }
        },
        computed:{
            leadsArray(){
                return JSON.parse(this.leads);
            }
        },
        created(){
            this.leadsDraw = this.leadsArray.data
        }
    }
</script>

<style scoped>

</style>
