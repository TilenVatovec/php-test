import { useEffect, useState } from "react";
import MultiLevelDropdown from "./MultiLevelDropdown";
import axios from "axios";


const Categories = () => {
    const [data, setData] = useState<any[]>([])
    useEffect(() => {

        const fetchData = async () =>{
          const data =  await axios("http://localhost/php-test/categories")
      
          if (data.data)
             {
              console.log(`🚀 ~ file: App.tsx:23 ~  data.data:`,  data.data)
              setData(data.data)
             }
        }
      
        fetchData()
       },[])

  return (
    <div className="p-4">
      <h2 className="text-xl font-bold mb-4">E-commerce Categories</h2>
      <MultiLevelDropdown items={data} />
    </div>
  );
};

export default Categories;