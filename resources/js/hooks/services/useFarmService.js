import { useState } from "react";
import axios from "axios";

const useFarmService = () => {
    const [farm, setFarm] = useState([]);
    const [farms, setFarms] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const index = async () => {
        setLoading(true);
        setError(false);
        await axios
            .get("/api/farms")
            .then((res) => {
                setFarms(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });
        setLoading(false);
    };

    const show = async (farmID) => {
        setLoading(true);
        await axios
            .get(`/api/farms/${farmID}`)
            .then((res) => {
                setFarm(res.data);
            })
            .catch((err) => {
                setError(err);
            });

        setLoading(false);
    };

    return { index, show, farm, farms, loading, error };
};
export default useFarmService;
