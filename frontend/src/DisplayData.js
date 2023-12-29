import React, { useState, useEffect } from 'react'
import axios from 'axios'; 
import './TableStyle.css';

const DisplayData = () => {
  const [data, setData] = useState([]); // хук для хранения данных
  const [activeLog, setActiveLog] = useState('wp_s3cu_form_on_landing'); // хук для хранения текущей таблицы
  const [page, setPage] = useState(1); // хук для хранения текущей страницы

  const fetchNextPage = () => { // Загрузка следующей страницы
    setPage(prevPage => Number(prevPage) + 1);
  }

  useEffect(() => { // Хук, который вызывается при изменении activeLog или загрузке страницы
    const fetchData = async () => { // Асинхронная функция для получения данных
      try {
        const response = await axios.get(`https://localhost/backend/process_data.php?api=${activeLog}&page=${page}`); // Выполнение GET-запроса
        if (page === 1) {
          setData([...Object.values(response.data)]); // Если это первая страница, то заменяем данные
        } else {
          setData((prevData) => [...prevData, ...Object.values(response.data)]); // Если это не первая страница, то добавляем её данные к текущим данным
        }
      } catch (error) {
        console.error("Error fetching data: ", error);
      }
    };

    fetchData();
  }, [activeLog, page]); // Зависимости useEffect: activeLog и page

  const renderHeaders = () => { // Функция для отрисовки заголовков в зависимости от текущей таблицы
    return activeLog === "wp_s3cu_form_on_landing" ? (
      <thead>
        <tr>
          <th>ID</th>
          <th>Main Point</th>
          <th>Sex</th>
          <th>Age</th>
          <th>Params</th>
          <th>Created At</th>
          <th>Updated At</th>
        </tr>
      </thead>
    ) : (
      <thead>
        <tr>
          <th>ID</th>
          <th>IP</th>
          <th>DateTime</th>
          <th>Request Method</th>
          <th>URL</th>
          <th>Protocol</th>
          <th>Status Code</th>
          <th>Response Size</th>
          <th>Referrer</th>
          <th>User Agent</th>
        </tr>
      </thead>
    );
  };

  return ( // Отрисовка компонента
    <div>
      <button onClick={() => {setActiveLog("wp_s3cu_form_on_landing"); setPage(1); setData([]);}}>
        Show WP_s3cu_form_on_landing
      </button>
      <button onClick={() => {setActiveLog("apache_logs"); setPage(1); setData([]);}}>
        Show Apache Logs
      </button>
      <table className="styled-table">
        {renderHeaders()}
        <tbody>
          {data.map((item, index) => (
            <tr key={index}>
              {Object.values(item).map((value, i) => (
                <td key={i}>{value}</td>
              ))}
            </tr>
          ))}
        </tbody>
      </table>
      <button onClick={fetchNextPage}>
        Load More
      </button>
    </div>
  );
};

export default DisplayData;