<template>
    <div>

<div class="breadcrumbs-area">
    <h3>Blog form</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Blog form</li>
    </ul>
</div>

   <form @submit.stop.prevent="onSubmit" class="form-horizontal">


                            <div class="row">













                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" v-model="form.title" id="title"
                                            value="">
                                    </div>

                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category</label>



                                        <select v-model="form.cat_id" id="category" class="form-control" >

                                            <option value="">Select</option>

                                                <option v-for="cat in categorys" :key="cat.id" :value="cat.id">{{ cat.name }}</option>




                                        </select>



                                    </div>

                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <input type="text" class="form-control" v-model="form.short_description"
                                            id="short_description" value="">
                                    </div>

                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>

                                        <vue-editor v-model="form.long_description" />

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-form-label">ছবি
                                        </label>

                                            <input type="file" class="form-control" id="Images"  @change="FileSelected($event, 'Images')"  />
                                            <label for="Images">
                                            <img thumbnail fluid :src="form.Images" alt="Image 3"/>
                                            </label>
                                    </div>
                                </div>





                            </div>











                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">

                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>



  </form>


    </div>
</template>

<script>
export default {
    data(){
        return {
           form: {
                title:null,
                cat_id:null,
                short_description:null,
                long_description:null,
                Images:null,
             },
             categorys:{},
        }
    },
    methods:{



		FileSelected($event, parent_index){



			let file = $event.target.files[0];
			if (file.size > 5048576) {
				Notification.image_validation();
			} else {
				let reader = new FileReader;
				reader.onload = event => {
					this.form[parent_index] = event.target.result
					// console.log(event.target.result);
				};
				reader.readAsDataURL(file)
			}
                    //   console.log($event.target.result);
		},



      async getCategory(){

        var res = await this.callApi('get',`/api/get/category/list?type=all`,[]);
        this.categorys = res.data


        },

       getunionInfo(id=''){

                axios.get(`/api/update/blog/${id}`)
                .then((res)=>{

                    this.form = res.data
                })

        },


        async onSubmit() {
            var res = await this.callApi('post', '/api/update/blog', this.form);

    // conseole.log(res)
    this.getunionInfo();
    this.$router.push({ name: 'blogs'})
    Notification.customSuccess('Blog Update Successfuly Done');


        }
    },
    mounted(){
        if(this.$route.params.id){

           this.getunionInfo(this.$route.params.id);
        }
        this.getCategory();
        }
}
</script>
