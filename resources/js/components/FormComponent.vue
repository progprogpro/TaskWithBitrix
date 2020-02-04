<template>
    <div class="wrapper">
        <loading :active.sync="isLoading"
                 :is-full-page="true"></loading>
        <h4 class="text-center">Добавление лида</h4>
        <hr>
        <form :action="action" v-on:submit="onSubmitForm($event)" method="post" id="form-component">
            <div class="form-group">
                <label>Тип кузова:</label>
                <select name="car_category" id="car_categories" v-model="selectCategory"  class="form-control" @change="getMarks" required>
                    <option :value="category.value"  v-for="category in categoriesAutoDropdownList">{{category.name}}</option>
                </select>
                <small :class="validation.hasError('selectCategory') ? 'text-danger': 'text-muted'" class="form-text" required>{{ validation.firstError('selectCategory') || 'Выберите тип кузова автомобиля.' }}</small>
            </div>
            <div class="form-group">
                <label>Марка:</label>
                <select name="car_mark" id="car_mark" v-model="selectMark" class="form-control" @change="getModels()" required>
                    <option :value="mark.value" :key="mark.value" v-for="mark in marksDropdownList">{{mark.name}}</option>
                </select>
                <small :class="validation.hasError('selectMark') ? 'text-danger' : 'text-muted'" class="form-text" required>{{ validation.firstError('selectMark') || 'Выберите марку автомобиля.' }}</small>
            </div>
            <div class="form-group">
                <label>Модель:</label>
                <select name="car_model" id="car_model" v-model="selectModel" class="form-control" required>
                    <option :value="model.value" :key="model.value" v-for="model in modelsDropdownList">{{model.name}}</option>
                </select>
                <small :class="validation.hasError('selectModel') ? 'text-danger' :'text-muted'" class="form-text">{{ validation.firstError('selectModel') || 'Выберите модель автомобиля.' }}</small>
            </div>
            <div class="form-group">
                <label>Имя лида:</label>
                <input type="text" name="lead_name" class="form-control"  v-model="leadNameModel" minlength="2" maxlength="255" placeholder="-" required>
                <small class="text-danger">{{ validation.firstError('leadNameModel') }}</small>
            </div>
            <div class="form-group">
                <label>Тел. лида:</label>
                <input type="tel" name="lead_phone" class="form-control" v-model="leadPhoneModel" minlength="10" maxlength="10" placeholder="(XXX) XXX XXXX" required>
                <small class="text-danger">{{ validation.firstError('leadPhoneModel') }}</small>
            </div>
            <div class="form-group">
                <label>Email адресс:</label>
                <input type="email" name="lead_mail" class="form-control"  placeholder="Email" v-model="leadEmailModel" required>
                <small class="text-danger">{{ validation.firstError('leadEmailModel') }}</small>
            </div>
            <input type="hidden" name="_token" :value="token">
            <div class="text-center mt-5">
                <button @click="resetForm" class="btn btn-outline-secondary btn-reset">Reset</button>
                <button @click="beforeSubmit" class="btn btn-primary w-75">Отправить</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        name: "form-component",
        props: {
            action: {type: String, required: true},
            routeGetMarks: {type: String, required: true},
            routeGetModels: {type: String, required: true},
            routeGetCategoriesAuto: {type: String, required: true},
        },
        data: function(){
            return {
                form: $('#form-component'),

                // dropdown lists
                marksDropdownList: null,
                modelsDropdownList: null,
                categoriesAutoDropdownList: null,

                // form dropdown models
                selectCategory: null,
                selectMark: null,
                selectModel: null,

                // form models
                leadPhoneModel: '0992322233',
                leadNameModel: 'Brian',
                leadEmailModel: 'ponchik@mail.ru',
            }
        },
        validators: {
            selectCategory: function(value) {
                return this.Validator.value(value).required();
            },
            selectMark: function(value) {
                return this.Validator.value(value).required();
            },
            selectModel: function(value) {
                return this.Validator.value(value).required();
            },
            leadNameModel: function(value) {
                return this.Validator.value(value).required().minLength(2).maxLength(255).regex('^[A-Za-z]*$', 'Must only contain alphabetic characters.');
            },
            leadEmailModel: function(value) {
                return this.Validator.value(value).required().email('That doesn\'t look like a valid email address.');
            },
            leadPhoneModel: function(value) {
                return this.Validator.value(value).required().digit().length(10);
            }
        },
        methods:{
            onSubmitForm(event){

                // validate form
                this.$validate()
                    .then(function(success) {
                        if (!success)
                            event.preventDefault();
                    });
            },
            beforeSubmit: function(){
                this.form.submit();
            },
            getCategories(){

                // get categories of autos from autoria
                this.makeAjaxCall(this.routeGetCategoriesAuto,'GET')
                    .then(response => {
                        this.categoriesAutoDropdownList = response;
                    })

            },
            getMarks(){
                // to reset models and marks dropdown list
                this.modelsDropdownList = null;
                this.marksDropdownLis = null;

                // get marks of autos from autoria
                this.makeAjaxCall(this.routeGetMarks,'GET',{categoryId: this.selectCategory})
                    .then(response => this.marksDropdownList = response)

            },
            getModels(){
                // to reset models dropdown list
                this.modelsDropdownList = null;
                this.selectModel = null;

                // get models of autos from autoria
                this.makeAjaxCall(this.routeGetModels, 'GET',{categoryId: this.selectCategory, markId: this.selectMark})
                    .then(response => this.modelsDropdownList = response)

            },
            resetForm() {

                this.selectCategory = null;
                this.selectMark = null;
                this.selectModel = null;

                this.leadPhoneModel = null;
                this.leadNameModel = null;
                this.leadEmailModel = null;

                this.Validator.reset();
            }
        },
        created(){
            // get categories of autos from Autoria in the dropdown list
            this.getCategories();
        }
    }
</script>

<style>
    .wrapper{
        margin-bottom:40px;
        background: #fff;
        padding: 35px;
        border: 1px dashed #b3b3b3;
    }
    .btn-reset{
        width:23%;
    }
</style>
