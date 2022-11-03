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
                    <p
                        class="position-absolute top-0 start-50 translate-middle my-3"
                    >
                        User Name:
                    </p>
                    <button
                        class="btn btn-primary text-center position-absolute top-0 end-0"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"
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
                                    <th scope="col">Si N.</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
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

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div
            class="modal fade"
            id="staticBackdrop"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Modal title
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">...</div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Understood
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <button @click="logout()" class="btn btn-info">Logout</button>
    </div>
</template>

<style></style>
