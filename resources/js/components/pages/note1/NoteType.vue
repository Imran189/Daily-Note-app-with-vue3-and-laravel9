<script setup>
import axios from "axios";
import { reactive, ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const notes = ref("");
const user = ref("");
const showModal = ref(false);
const hideModal = ref(true);
const form = ref({
    note: "",
    status: "",
});

const router = useRouter();

onMounted(async () => {
    getNotes();
    getUser();
});

const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});

const user_id = localStorage.getItem("id");

const getUser = async () => {
    let response = await axios.get("/api/get_user_name/" + user_id);
    user.value = response.data.user;
    //console.log("userr", user.value);
};
const getNotes = async () => {
    let response = await axios.get("/api/get_notes/" + user_id);
    notes.value = response.data.notes;
};

const openModal = () => {
    showModal.value = !showModal.value;
};
const closeModal = () => {
    showModal.value = !hideModal.value;
    form.value = {};
};
const saveNote = async () => {
    await axios
        .post(`/api/save_note/${props.id}`, form.value)
        .then((response) => {
            getNotes();
            getUser();
            closeModal();
            toast.fire({
                icon: "success",
                title: "Note created Successfully",
            });
        });
};
const onRead = async (id, status) => {
    const formData = new FormData();
    formData.append("status", status);
    axios.post("/api/update_status/" + id, formData).then((response) => {
        getNotes();
        getUser();
        toast.fire({
            icon: "success",
            title: "Note Status updated Successfully",
        });
    });
};
const onDeleteNote = (id) => {
    Swal.fire({
        title: "Are you sure..?",
        text: "you can't go back",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes,delete it",
    }).then((result) => {
        if (result.value) {
            axios.get("/api/delete_note/" + id).then(() => {
                Swal.fire("Delete", "Note deleted Successfully", "success");
                getNotes();
                getUser();
            });
        }
    });
};
const onEditNote = (id) => {
    console.log("edit clicked");
    router.push("/note/edit/" + id);
};
const logout = () => {
    localStorage.removeItem("token");
    localStorage.removeItem("id");
    router.push("/");
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
                        User Name: {{ user.name }}
                    </p>
                    <button
                        class="btn btn-primary text-center position-absolute top-0 end-0"
                        type="button"
                        @click="openModal()"
                    >
                        Add new Note
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table table-dark my-4 border text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Si N.</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody
                                v-for="(item, index) in notes"
                                :key="item.id"
                                v-show="notes"
                            >
                                <tr>
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.note }}</td>
                                    <td>
                                        <p
                                            @click.prevent="onRead(item.id, 0)"
                                            class="badge rounded-pill bg bg-success"
                                            v-if="item.status == 1"
                                        >
                                            Read
                                        </p>
                                        <p
                                            @click.prevent="onRead(item.id, 1)"
                                            class="badge badge-sm rounded-pill bg bg-secondary"
                                            v-if="item.status == 0"
                                        >
                                            Unread
                                        </p>
                                    </td>

                                    <td>
                                        <button
                                            class="btn btn-sm btn-info mx-2"
                                            @click="onEditNote(item.id)"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-sm btn-danger"
                                            @click.prevent="
                                                onDeleteNote(item.id)
                                            "
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <p class="text-center" v-if="notes.length <= 0">
                                This User Has no data yet
                            </p>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal main__modal my-3" :class="{ show: showModal }">
            <div class="modal__content bg-dark text-white border border-light">
                <span
                    class="modal__close btn__close--modal"
                    @click="closeModal()"
                    >×</span
                >
                <h3 class="modal__title">Add Education</h3>
                <hr class="modal_line" />
                <br />
                <form @submit.prevent="saveNote()">
                    <label class="form-label">Note</label>
                    <textarea
                        type="text"
                        class="form-control"
                        v-model="form.note"
                    />

                    <div class="my-2">
                        <label class="form-label">status</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="form.status"
                        />
                    </div>

                    <br />
                    <hr class="modal_line" />
                    <div class="model__footer">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <button @click="logout()" class="btn btn-info">ogout</button>
    </div>
</template>

<style scoped>
.bg {
    cursor: pointer;
}
.show {
    display: block !important;
    transition: 0.3s ease all;
}

.modal__content {
    background-color: white;
    margin: auto;
    padding: 20px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 2px 15px rgb(35 40 47 / 25%);
    position: relative;
    border: none;
    border-radius: 7px;
}

.modal__close {
    color: #aaaaaa;
    font-size: 28px;
    font-weight: bold;
    top: 5px;
    right: 15px;
    position: absolute;
    cursor: pointer;
}

.modal__title {
    margin-bottom: 20px;
}
.modal_line {
    border: 1px solid #e0e0e0;
    margin-left: -20px;
    margin-right: -20px;
}

.modal__items {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.model__footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
</style>
