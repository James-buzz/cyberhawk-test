import { useState } from "react";
import axios from "axios";

const useInspectionService = () => {
    const [inspection, setInspection] = useState([]);
    const [inspections, setInspections] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const index = async (prefix = "") => {
        setLoading(true);
        setError(false);
        await axios
            .get(`/api/${prefix}inspections`)
            .then((res) => {
                setInspections(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });
        setLoading(false);
    };

    const show = async (inspectionID) => {
        setLoading(true);
        await axios
            .get(`/api/inspections/${inspectionID}`)
            .then((res) => {
                setInspection(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });

        setLoading(false);
    };

    return { index, show, inspection, inspections, loading, error };
};
export default useInspectionService;
