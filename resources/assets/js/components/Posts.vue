<template>

    <div class="table-responsive">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New Post</button>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Body</th>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Image 3</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="post in $parent.posts.data">
                <td>{{post.id}}</td>
                <td> {{post.body}}</td>
                <td> <img :src='base_url+"/imgs/"+post.img1'/> </td>
                <td> <img :src='base_url+"/imgs/"+post.img2'/> </td>
                <td> <img :src='base_url+"/imgs/"+post.img3'/> </td>

            </tr>
            </tbody>
        </table>
        <paginate
                ref="paginate"
                :page-count="$parent.last_page"
                :page-range="5"
                :margin-pages="2"
                :click-handler="callBack"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
                :page-class="'page-item'">
            <span slot="prevContent">Previous</span>
            <span slot="nextContent">Next</span>
        </paginate>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Post</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Body <span style="color:red">*</span>:</label>
                                <div class="col-md-9">
                                    <input v-model="newPost.body" required type="text" class="form-control"
                                           placeholder="Post's body">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Body <span style="color:red">*</span>:</label>
                                <div class="col-md-3">

                                    <input required type="file" ref="image1"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">

                                    <input required type="file" ref="image2"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">

                                    <input required type="file" ref="image3"
                                           class="form-control">
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                        <button @click="update" class="btn btn-success pull-left" data-dismiss="modal">Add</button>


                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>

    export default {

        data(){
            return {
                flag: '0',
                count: '',
                newPost: [],
                base_url: window.location.origin,

            }
        },
        mounted() {
            // you can change the prop after mounted
            this.$refs.paginate.selected = 0
        },
        methods: {
            callBack: function () {

                //console.log(this.count)
                if (this.flag) {
                    console.log(this.$refs.paginate.selected);
                    this.$parent.clickCallback(this.$refs.paginate.selected);
                }
                this.flag = 1;

            },


            update() {
                var data = new FormData()
                var image1 = this.$refs.image1.files[0]
                var image2 = this.$refs.image2.files[0]
                var image3 = this.$refs.image3.files[0]
                var body = this.newPost.body
                data.append('image1', image1)
                data.append('image2', image2)
                data.append('image3', image3)
                data.append('body', body)
                axios.post('/posts', data)
                    .then(response => {
                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }


        }
    }
</script>
