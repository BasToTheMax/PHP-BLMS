<!-- Required libraries -->
<script src="https://cdn.jsdelivr.net/npm/superagent@10.1.1/dist/superagent.min.js"></script>

<!-- Main script -->
<script>
    // Send rpc calls
    async function rpc(method, params) {
        const res = await superagent
            .post('/api.php')
            .send({
                    jsonrpc: '2.0',
                    method,
                    params,
                    id: Date.now()
            })
            .set('accept', 'application/json');

        if (res.body.error) {
            throw new Error(`[${res.error.code}]: ${res.error.message}`);
        }

        return res.body.result;
    }

    rpc('site.ping', {}).then(r => {
        console.log("Pong:", r);
    }).catch(err => {
        console.error("RPC error:", err);
    });
</script>