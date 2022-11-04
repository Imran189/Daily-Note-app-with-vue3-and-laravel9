<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import router from "../../../router";
const note = ref("");
const form = ref({
    note: "",
    date: "",
});
onMounted(async () => {
    getEditNote();
});
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});

const getEditNote = async () => {
    let response = await axios.get(`/api/get_edit_note/${props.id}`);
    form.value = response.data.note;
};

const updateNote = async () => {
    await axios
        .post(`/api/update_note/${props.id}`, form.value)
        .then((response) => {
            router.push("/admin/home");
            toast.fire({
                icon: "success",
                title: "Note Updated successfully",
            });
        });
};
</script>
<template>
    <div class="container">
        <div class="card my-2 bg-dark text-white">
            <div class="card-title mx-4 my-2 text-center fs-2">Edit Note</div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="card-body mx-2">
                        <form @submit.prevent="updateNote()">
                            <div class="mb-3">
                                <label
                                    for="exampleInputEmail1"
                                    class="form-label"
                                    >Note</label
                                >
                                <textarea
                                    type="text"
                                    class="form-control"
                                    v-model="form.note"
                                />
                            </div>
                            <div class="mb-3">
                                <label
                                    for="exampleInputPassword1"
                                    class="form-label"
                                    >Date</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.date"
                                />
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</template>

<style></style>
