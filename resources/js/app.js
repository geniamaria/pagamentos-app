import { createApp } from "vue";
import BackOffice from "./components/BackOffice.vue";
import PagamentoForm from "./components/PagamentoForm.vue";

const app = createApp({});
app.component("back-office", BackOffice);
app.component("pagamento-form", PagamentoForm);
app.mount("#app");