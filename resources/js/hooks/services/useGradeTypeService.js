import { useState } from "react";
import axios from "axios";

const useGradeTypeService = () => {
    const [gradeType, setGradeType] = useState([]);
    const [gradeTypes, setGradeTypes] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const index = async (prefix = "") => {
        setLoading(true);
        setError(false);
        await axios
            .get(`/api/${prefix}grade-types`)
            .then((res) => {
                setGradeTypes(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });
        setLoading(false);
    };

    const show = async (gradeTypeID) => {
        setLoading(true);
        await axios
            .get(`/api/grade-types/${gradeTypeID}`)
            .then((res) => {
                setGradeType(res.data);
            })
            .catch((err) => {
                setError(err);
            });

        setLoading(false);
    };

    return { index, show, gradeType, gradeTypes, loading, error };
};
export default useGradeTypeService;
