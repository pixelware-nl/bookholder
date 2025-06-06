import { h } from "vue";

export const columns: ColumnDef<Payment>[] = [
    {
        accessorKey: "company",
        header: () => h("div", "Company"),
        cell: ({ row }) => {
            return h("div", { class: "font-medium" }, row.getValue("company"));
        },
    },
    {
        accessorKey: "rate",
        header: () => h("div", "Amount"),
        cell: ({ row }) => {
            const amount = Number.parseFloat(row.getValue("rate"));
            let formatted = new Intl.NumberFormat("nl-NL", {
                style: "currency",
                currency: "EUR",
            }).format(amount);
            formatted = formatted + "/hr";

            return h("div", { class: "font-medium" }, formatted);
        },
    },
    {
        accessorKey: "hours",
        header: () => h("div", "Status"),
        cell: ({ row }) => {
            return h("div", { class: "font-medium" }, row.getValue("hours"));
        },
    },
];
