<template>
    <div>
        <div class="row my-4" v-for="(chunk, index) in list" :key="index">
            <div class="col-3" v-for="product in chunk" :key="product.id">
                <div class="card">
                    <img :src="product.image.content" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">$ {{ product.price }}</h6>
                        <p class="card-text">Facturas: {{ product.invoices_count  }}.</p>
                        <a href="#" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        products: {
            type: Array
        }
    },
    computed: {
        list () {
            return _.chunk(this.products, 4)
        }
    }
}
</script>
