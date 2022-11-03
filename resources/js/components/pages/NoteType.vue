<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const logout = () => {
    localStorage.removeItem("token");
    router.push("/");
    console.log("token");
};
</script>
<template>
    <div class="container my-2">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="position-relative">
                    <h3 class="position-absolute start-0 end-0">Daily Notes</h3>
                    <button
                        class="btn btn-primary text-center position-absolute top-0 end-0"
                    >
                        Add new Note
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table table-dark my-4 mx-3 border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <button @click="logout()" class="btn btn-info">Logout</button>
    </div>
</template>

<style></style>
