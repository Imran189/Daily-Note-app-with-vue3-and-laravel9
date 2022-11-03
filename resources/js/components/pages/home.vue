<script setup>
import { useRouter } from "vue-router";
const router = useRouter();

const note1 = () => {
    router.push("/login");
};
</script>
<template>
    <div>
        <h1>TWO NOTE BOOK PRACTICE</h1>
        <div class="context">
            <div @click="note1()" class="button">Note 1</div>
            <div @click="note1()" class="button">Note 2</div>
        </div>
    </div>
</template>

<style scoped>
H1 {
    color: rgb(15, 14, 14);
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    width: 100%;
    text-align: center;
    margin-top: 100px;
}
.context {
    text-align: center;
    padding: 100px;
}

.button {
    display: inline-block;
    background: #4285f4;
    color: #fff;
    text-transform: uppercase;
    margin-right: 50px;
    padding: 20px 30px;
    border-radius: 5px;
    box-shadow: 0px 17px 10px -10px rgba(0, 0, 0, 0.4);
    cursor: pointer;
    -webkit-transition: all ease-in-out 300ms;
    transition: all ease-in-out 300ms;
}
.button:hover {
    box-shadow: 0px 37px 20px -20px rgba(0, 0, 0, 0.2);
    -webkit-transform: translate(0px, -10px) scale(1.2);
    transform: translate(0px, -10px) scale(1.2);
}
</style>
