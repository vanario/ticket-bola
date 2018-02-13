    header("Content-type: text/css; charset: UTF-8");


      @font-face {
        font-family: 'Droid';
        font-style: normal;
        font-weight: normal;
        src: url('dompdf/lib/fonts/DroidSansFallback.ttf') format('truetype');
      }
      .report-table {
          display: block;
          margin-bottom: 30px;
      }
      .table {
        width: 100%;
      }
      .table>tbody>tr>td {
        padding: 10px 6px;
        font-size: 14px;
        letter-spacing: 0.03em;
        border-bottom:1px solid #ddd;
      }

      .table>thead {
          background: #ddd;
          padding: 0;
          font-size: 14px;
      }

      .table>thead>tr>th {
        padding: 10px 0;
        font-weight: 500;
        letter-spacing: 0.03em;
      }

      /* css custom header */
      .report-print {
          width: 700px;
          height: auto;
          border: 1px solid #ccc;
          margin: 10px auto;
      }
      .report-print__header {
          border-bottom-color: #4d4d4d;
          border-bottom: double;
          position: relative;
          text-align: center;
          padding-right: 120px;
          padding-left: 120px;
          padding-top: 30px;
          padding-bottom: 30px;
          margin-bottom: 30px;
      }
      .report-print__header h4 {
          margin-top: 0;
          margin-bottom: 0;
      }

      .header-table {
            text-align: center;
            border-bottom: 1px solid #4d4d4d;
            text-transform: uppercase;
            color: #4d4d4d;
            width: 100%;
            height: 180px;
            margin-bottom: 12px;
            display: inline-block;
        }
        .header-table h4 {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .header-table-right,
        .header-table-left {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .header-table-left {
            width: 50%;
            float: left;
        }
        .header-table-left table,
        .header-table-right table {
            width: 100%;
            margin-left: 10px;
        }

        .header-table-right {
            width: 50%;
            float: left;
        }

        .header-table table>tbody>tr>td {
            text-align: left;
            font-size: 14px;
            text-transform: none;
            padding-bottom: 10px;
        }

      .signature {
            border-top: double;
            padding: 20px;
            margin-top: 20px;
        }
        .signature-box {
            display: inline-block;
            width: 100%;
        }
        .signature-left {
            float: left;
            width: 40%;
            text-align: center;
            position: relative;
            border-bottom: 1px dotted #4d4d4d;
            margin: 10px 20px;
        }
        .signature-right {
            float: left;
            width: 40%;
            text-align: center;
            position: relative;
            border-bottom: 1px dotted #4d4d4d;
            margin: 10px 20px;
        }
        .signature-center {
            float: left;
            width: 42%;
            text-align: center;
            position: relative;
            margin-left: 28%;
            border-bottom: 1px dotted #4d4d4d;
        }
        .signature-border {
            margin-top: 80px;
            font-size: 14px;
        }
  