<template>
    <div class="container box">
        <form>
            <h1 class="form">{{ "Registration Form" }}</h1>
            <div class="form-group form">
                <label for="name">{{ "Name" }}</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="Enter Name"
                    name="Name"
                    v-model="studentName"
                />
            </div>
            <div class="form-group form">
                <label for="address">{{ "Address" }}</label>
                <input
                    type="text"
                    class="form-control"
                    id="address"
                    placeholder="Enter Address"
                    name="Address"
                    v-model="studentAddress"
                />
            </div>
            <div class="form-group form">
                <label for="email">{{ "Email" }}</label>
                <input
                    type="text"
                    class="form-control"
                    id="email"
                    placeholder="Enter Email"
                    name="Email"
                    v-model="studentEmail"
                />
            </div>
            <button
                type="submit"
                class="btn btn-primary form"
                @click.prevent="saveRecord()"
            >
                {{ "Submit" }}
            </button>

            <router-link to="/dashboard" type="button" class="btn btn-dark"
                >{{ "Back" }}
            </router-link>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            students: [],
            studentName: "",
            studentAddress: "",
            studentEmail: "",
            studentId: null,
            isNew: true
        };
    },

    mounted() {},

    methods: {
        saveRecord() {
            let student = {
                name: this.studentName,
                address: this.studentAddress,
                email: this.studentEmail
            };
            axios.post("create-student", student).then(response => {                
                if (response.data) {
                    this.$swal({
                        title: "Succeed",
                        text: "Student Fee created successfully",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                    }).then(result => {
                        if (result.isConfirmed) {
                            this.$router.push({ path: "/student-information" });
                        }
                    });
                }
            });
        }
    }
};
</script>

<style scoped>
.form {
    margin: 30px;
}

.box {
    margin-top: 50px;
    background-color: lightgray;
}
</style>
