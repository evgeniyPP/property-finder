<template>
    <el-main>
        <el-table :data="data" v-loading="loading" style="width: 100%">
            <el-table-column prop="name" label="Name"> </el-table-column>
            <el-table-column prop="bedrooms" label="Bedrooms"></el-table-column>
            <el-table-column
                prop="bathrooms"
                label="Bathrooms"
            ></el-table-column>
            <el-table-column prop="storeys" label="Storeys"></el-table-column>
            <el-table-column prop="garages" label="Garages"></el-table-column>
            <el-table-column prop="price" label="Price"></el-table-column>
        </el-table>
    </el-main>
</template>

<script>
export default {
    name: 'Results',
    props: {
        data: {
            type: Array,
            required: true,
        },
        loading: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
